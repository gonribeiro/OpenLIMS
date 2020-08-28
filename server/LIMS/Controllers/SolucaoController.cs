using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using LIMS.Models;

namespace LIMS.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class SolucaoController : ControllerBase
    {
        private readonly LimsContext _context;

        public SolucaoController(LimsContext context)
        {
            _context = context;
        }

        // GET: api/Solucao
        [HttpGet]
        public async Task<ActionResult<IEnumerable<Solucao>>> GetSolucoes()
        {
            return await _context.Solucoes
                .Include(p => p.Padrao)
                .Include(s => s.Solvente)
                .Include(e => e.Equipamento)
                .Include(u => u.Unidade)
                .ToListAsync();
        }

        // GET: api/Solucao/5
        [HttpGet("{id}")]
        public async Task<ActionResult<Solucao>> GetSolucao(int id)
        {
            var solucao = await _context.Solucoes.FindAsync(id);

            if (solucao == null)
            {
                return NotFound();
            }

            return solucao;
        }

        // PUT: api/Solucao/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for
        // more details see https://aka.ms/RazorPagesCRUD.
        [HttpPut("{id}")]
        public async Task<IActionResult> PutSolucao(int id, Solucao solucao)
        {
            if (id != solucao.Id)
            {
                return BadRequest();
            }

            _context.Entry(solucao).State = EntityState.Modified;

            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!SolucaoExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return NoContent();
        }

        // POST: api/Solucao
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for
        // more details see https://aka.ms/RazorPagesCRUD.
        [HttpPost]
        public async Task<ActionResult<Solucao>> PostSolucao(Solucao solucao)
        {
            _context.Solucoes.Add(solucao);
            await _context.SaveChangesAsync();

            return CreatedAtAction("GetSolucao", new { id = solucao.Id }, solucao);
        }

        // DELETE: api/Solucao/5
        [HttpDelete("{id}")]
        public async Task<ActionResult<Solucao>> DeleteSolucao(int id)
        {
            var solucao = await _context.Solucoes.FindAsync(id);
            if (solucao == null)
            {
                return NotFound();
            }

            _context.Solucoes.Remove(solucao);
            await _context.SaveChangesAsync();

            return solucao;
        }

        private bool SolucaoExists(int id)
        {
            return _context.Solucoes.Any(e => e.Id == id);
        }
    }
}
